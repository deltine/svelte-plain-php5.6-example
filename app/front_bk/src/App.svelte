<script lang="ts">
	import { Router, Link, Route } from "svelte-routing";
	import LoginCheck from "./routes/LoginCheck.svelte";

	export let url = "";
</script>

<Router {url}>
	<nav>
		<Link to="/">Home</Link>
		<Link to="loginCheck">LoginCheck</Link>
		<Link to="blog">Blog</Link>
	</nav>
	<div>
		<Route path="loginCheck" component={LoginCheck} />
	</div>
</Router>

Home
