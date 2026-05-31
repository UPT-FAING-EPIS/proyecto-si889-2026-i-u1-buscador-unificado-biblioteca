<?php

$allowedViews = [
	'home/index',
	'search/results',
	'details/details',
	'auth/login',
	'auth/register',
	'dashboard/profile',
];

$pageTitles = [
	'home/index' => 'NexusLib - Inicio',
	'search/results' => 'Resultados de búsqueda - NexusLib',
	'details/details' => 'Detalles del Libro - NexusLib',
	'auth/login' => 'Iniciar Sesión - NexusLib',
	'auth/register' => 'Registrarse - NexusLib',
	'dashboard/profile' => 'Mi Perfil - NexusLib',
];

function view_url(string $view, array $query = []): string
{
	$basePath = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
	$query = array_merge(['view' => $view], $query);

	return $basePath . '?' . http_build_query($query);
}

$currentView = isset($_GET['view']) ? trim((string) $_GET['view']) : 'home/index';
if (!in_array($currentView, $allowedViews, true)) {
	$currentView = 'home/index';
}

$viewFile = __DIR__ . '/../Views/' . $currentView . '.php';

$viewRoutes = [];
foreach ($allowedViews as $allowedView) {
	$viewRoutes[$allowedView] = view_url($allowedView);
}

ob_start();
require __DIR__ . '/../Views/layouts/header.php';
$headerMarkup = ob_get_clean();

$headerMarkup = str_replace(
	'<title>NexusLib - Inicio</title>',
	'<title>' . htmlspecialchars($pageTitles[$currentView] ?? 'NexusLib', ENT_QUOTES, 'UTF-8') . '</title>',
	$headerMarkup
);

if ($currentView === 'auth/login') {
	$headerMarkup = str_replace(
		'<body class="text-gray-100">',
		'<body class="text-gray-100 flex items-center justify-center min-h-screen px-4">',
		$headerMarkup
	);
} elseif ($currentView === 'auth/register') {
	$headerMarkup = str_replace(
		'<body class="text-gray-100">',
		'<body class="text-gray-100 flex items-center justify-center min-h-screen px-4 py-8">',
		$headerMarkup
	);
}

echo $headerMarkup;
require __DIR__ . '/../Views/layouts/navbar.php';
require $viewFile;
require __DIR__ . '/../Views/layouts/footer.php';

?>
<script>
(function () {
	const currentView = <?php echo json_encode($currentView, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
	const viewRoutes = <?php echo json_encode($viewRoutes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
	const pageTitles = <?php echo json_encode($pageTitles, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

	const routeMap = {
		'/home/index.html': 'home/index',
		'/search/results.html': 'search/results',
		'/details/details.html': 'details/details',
		'/auth/login.html': 'auth/login',
		'/auth/register.html': 'auth/register',
		'/dashboard/profile.html': 'dashboard/profile',
	};

	function viewUrl(view, params = {}) {
		const baseUrl = new URL(viewRoutes[view] || viewRoutes['home/index'], window.location.origin);
		Object.entries(params).forEach(([key, value]) => {
			if (value !== undefined && value !== null && value !== '') {
				baseUrl.searchParams.set(key, value);
			}
		});
		return baseUrl.pathname + baseUrl.search + baseUrl.hash;
	}

	function ensureNavbarState() {
		const guestNav = document.getElementById('navbar-guest');
		const authNav = document.getElementById('navbar-auth');
		const userData = getUserData();

		if (!guestNav || !authNav) {
			return;
		}

		if (userData) {
			guestNav.classList.add('hidden');
			authNav.classList.remove('hidden');

			const userName = document.getElementById('user-name');
			if (userName) {
				userName.textContent = 'Hola, ' + userData.name;
			}
		} else {
			guestNav.classList.remove('hidden');
			authNav.classList.add('hidden');
		}
	}

	function getUserData() {
		const rawUser = localStorage.getItem('nexuslib_user');
		if (!rawUser) {
			return null;
		}

		try {
			return JSON.parse(rawUser);
		} catch (error) {
			return null;
		}
	}

	function rewriteLinks() {
		document.querySelectorAll('a[href]').forEach((anchor) => {
			const originalHref = anchor.getAttribute('href');
			if (!originalHref) {
				return;
			}

			const cleanedHref = originalHref.split('#')[0];
			const hash = originalHref.includes('#') ? '#' + originalHref.split('#').slice(1).join('#') : '';
			const queryIndex = cleanedHref.indexOf('?');
			const path = queryIndex >= 0 ? cleanedHref.slice(0, queryIndex) : cleanedHref;
			const queryString = queryIndex >= 0 ? cleanedHref.slice(queryIndex + 1) : '';
			const view = routeMap[path];

			if (!view) {
				return;
			}

			const params = new URLSearchParams(queryString);
			anchor.setAttribute('href', viewUrl(view, Object.fromEntries(params.entries())) + hash);
		});
	}

	function setAuthBodyClasses() {
		if (currentView === 'auth/login') {
			document.body.classList.add('flex', 'items-center', 'justify-center', 'min-h-screen', 'px-4');
		}

		if (currentView === 'auth/register') {
			document.body.classList.add('flex', 'items-center', 'justify-center', 'min-h-screen', 'px-4', 'py-8');
		}
	}

	function goToSearch(query) {
		const origin = document.querySelector('input[name="origin"]:checked')?.value || '';
		const params = {};

		if (query) {
			params.q = query;
		}

		if (origin) {
			params.origin = origin;
		}

		window.location.href = viewUrl('search/results', params);
	}

	function goToDetails(bookId) {
		window.location.href = viewUrl('details/details', { id: bookId });
	}

	function search(query) {
		const params = {};

		if (query) {
			params.q = query;
		}

		window.location.href = viewUrl('search/results', params);
	}

	function handleLogin(event) {
		event.preventDefault();

		const email = document.getElementById('email')?.value || '';
		const password = document.getElementById('password')?.value || '';

		if (!email || !password) {
			alert('Por favor completa todos los campos.');
			return;
		}

		localStorage.setItem('nexuslib_user', JSON.stringify({
			email: email,
			name: email.split('@')[0].charAt(0).toUpperCase() + email.split('@')[0].slice(1),
		}));

		alert('¡Sesión iniciada correctamente!');
		window.location.href = viewUrl('dashboard/profile');
	}

	function handleRegister(event) {
		event.preventDefault();

		const name = document.getElementById('name')?.value || '';
		const email = document.getElementById('email')?.value || '';
		const password = document.getElementById('password')?.value || '';
		const confirmPassword = document.getElementById('confirm-password')?.value || '';

		if (!name || !email || !password || !confirmPassword) {
			alert('Por favor completa todos los campos.');
			return;
		}

		if (password !== confirmPassword) {
			alert('Las contraseñas no coinciden.');
			return;
		}

		if (password.length < 6) {
			alert('La contraseña debe tener al menos 6 caracteres.');
			return;
		}

		localStorage.setItem('nexuslib_user', JSON.stringify({
			email: email,
			name: name,
		}));

		alert('¡Cuenta creada correctamente! Bienvenido a NexusLib.');
		window.location.href = viewUrl('dashboard/profile');
	}

	function reserveBook() {
		if (!localStorage.getItem('nexuslib_user')) {
			alert('Debes iniciar sesión para reservar libros.');
			window.location.href = viewUrl('auth/login');
			return;
		}

		alert('¡Libro reservado exitosamente! Puedes recogerlo en la Biblioteca Central en 48 horas.');
	}

	function checkAuth() {
		const user = getUserData();

		if (!user) {
			window.location.href = viewUrl('auth/login');
			return;
		}

		const userName = document.getElementById('user-name');
		const profileName = document.getElementById('profile-name');
		const profileEmail = document.getElementById('profile-email');

		if (userName) {
			userName.textContent = 'Hola, ' + user.name;
		}

		if (profileName) {
			profileName.textContent = user.name;
		}

		if (profileEmail) {
			profileEmail.textContent = user.email;
		}
	}

	function logout() {
		localStorage.removeItem('nexuslib_user');
		ensureNavbarState();
		window.location.href = viewUrl('home/index');
	}

	function editProfile() {
		alert('Editar perfil - Feature próximamente disponible');
	}

	function removeSaved(element) {
		if (confirm('¿Deseas eliminar este libro de tus guardados?')) {
			element.closest('.bg-slate-700')?.remove();
			alert('Libro eliminado de favoritos.');
		}
	}

	function pickupBook() {
		alert('Recogida confirmada. Por favor, presenta tu ID en la biblioteca.');
	}

	function cancelReservation() {
		if (confirm('¿Deseas cancelar esta reserva?')) {
			alert('Reserva cancelada correctamente.');
			window.location.reload();
		}
	}

	window.viewUrl = viewUrl;
	window.goToSearch = goToSearch;
	window.goToDetails = goToDetails;
	window.search = search;
	window.handleLogin = handleLogin;
	window.handleRegister = handleRegister;
	window.reserveBook = reserveBook;
	window.checkAuth = checkAuth;
	window.logout = logout;
	window.editProfile = editProfile;
	window.removeSaved = removeSaved;
	window.pickupBook = pickupBook;
	window.cancelReservation = cancelReservation;
	window.toggleNavbarState = ensureNavbarState;

	document.addEventListener('DOMContentLoaded', function () {
		rewriteLinks();
		setAuthBodyClasses();
		ensureNavbarState();

		if (currentView === 'dashboard/profile') {
			checkAuth();
		}
	});

	if (pageTitles[currentView]) {
		document.title = pageTitles[currentView];
	}
})();
</script>
