	<script>
		function goToSearch(query) {
			const origin = document.querySelector('input[name="origin"]:checked')?.value || '';
			const params = new URLSearchParams();
			if (query) params.append('q', query);
			if (origin) params.append('origin', origin);
			window.location.href = '/search/results.html' + (params.toString() ? '?' + params.toString() : '');
		}
	</script>
</body>
</html>
<?php
