// assets/js/menu.js

function menuComponent(jsonData) {
	// --- Normaliza una cadena eliminando acentos y convirtiendo a minúsculas ---
	const normalize = s => (s || '').toString().toLowerCase()
		.normalize('NFD').replace(/[\u0300-\u036f]/g, '');

	// --- Divide una cadena en tokens alfanuméricos ---
	const tokenize = s => normalize(s).split(/[^a-z0-9]+/).filter(Boolean);

	// --- Convierte una consulta en términos individuales (palabras o frases entre comillas) ---
	const parseTerms = q => {
		const m = [...(q.match(/"([^"]+)"|\S+/g) || [])];
		return m.map(t => normalize(t.replace(/^"|"$/g, ''))).filter(Boolean);
	};

	// --- Verifica si alguno de los tokens comienza con el término buscado ---
	const startsInTokens = (tokens, term) =>
		tokens.some(tok => tok === term || tok.startsWith(term));

	// --- Propaga etiquetas (tags) desde nodos padres a hijos, creando un conjunto efectivo de etiquetas heredadas ---
	const withInheritedTags = (nodes, parentTags = []) =>
		nodes.map(n => {
			const own = Array.isArray(n.tags) ? n.tags : [];
			const effectiveTags = [...new Set([...parentTags, ...own])];
			const copy = { ...n, effectiveTags };
			if (Array.isArray(n.children)) copy.children = withInheritedTags(n.children, effectiveTags);
			return copy;
		});

	// --- Estructura original del menú con etiquetas heredadas ---
	const original = withInheritedTags(JSON.parse(jsonData));

	// --- Calcula una puntuación de relevancia para un nodo según los términos buscados ---
	const scoreNode = (node, terms) => {
		const titleTokens = tokenize(node.title);
		const tagTokens = (node.effectiveTags || []).flatMap(tokenize);
		let score = 0;
		for (const term of terms) {
			if (startsInTokens(titleTokens, term)) score += 6;   // Coincidencia parcial al inicio del título
			if (titleTokens.includes(term)) score += 5;         // Coincidencia exacta en el título
			if (startsInTokens(tagTokens, term)) score += 3;    // Coincidencia parcial al inicio de etiquetas
			if (tagTokens.includes(term)) score += 2;           // Coincidencia exacta en etiquetas
		}
		return score;
	};

	return {
		// --- Propiedades iniciales del componente ---
		originalMenu: original,
		search: '',
		filter: '',
		open: null,

		// --- Inicializa los eventos personalizados para filtrar y reiniciar el menú ---
		init() {
			window.addEventListener('menu:filter', e => {
				this.filter = e.detail;
				this.search = '';
				this.open = null;
			});
			window.addEventListener('menu:reset', () => {
				this.resetFilters();
			});
		},

		// --- Devuelve el menú filtrado según los términos de búsqueda y el filtro de categoría ---
		get filteredMenu() {
			const terms = parseTerms(this.search);
			const filterCat = normalize(this.filter);

			// --- Determina si un nodo coincide con los términos y la categoría ---
			const matchAND = (node) => {
				const titleTokens = tokenize(node.title);
				const tagTokens = (node.effectiveTags || []).flatMap(tokenize);

				const termOK = terms.every(term =>
					startsInTokens(titleTokens, term) ||
					startsInTokens(tagTokens, term)
				);

				const catOK = !filterCat ||
					startsInTokens(titleTokens, filterCat) ||
					startsInTokens(tagTokens, filterCat);

				return (terms.length ? termOK : true) && catOK;
			};

			// --- Aplica la búsqueda recursiva en todo el árbol de menús ---
			const recur = (nodes) => {
				const mapped = nodes.map(node => {
					const kids = Array.isArray(node.children) ? recur(node.children) : [];
					const isMatch = matchAND(node);
					if (isMatch || kids.length) {
						const score = terms.length ? scoreNode(node, terms) : 0;
						return { ...node, children: kids, _score: score };
					}
					return null;
				}).filter(Boolean);

				// --- Ordena los resultados por puntuación de relevancia ---
				return mapped.sort((a, b) => (b._score || 0) - (a._score || 0));
			};

			return recur(this.originalMenu);
		},

		// --- Aplica un filtro de categoría ---
		filterCategory(cat) { this.filter = cat; },

		// --- Reinicia todos los filtros y búsquedas ---
		resetFilters() { this.search = ''; this.filter = ''; this.open = null; },

		// --- Resalta los términos de búsqueda dentro del texto ---
		highlight(text) {
			if (!this.search) return text;
			const terms = parseTerms(this.search).map(t => t.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'));
			if (!terms.length) return text;
			const rx = new RegExp('\\b(' + terms.join('|') + ')', 'gi');
			return normalize(text)
				? text.replace(rx, '<mark class="bg-yellow-200">$1</mark>')
				: text;
		}
	}
}
