<script lang="ts">
	// import { Router, Link, Route } from "svelte-routing";
	import { Router, Route, Link } from "svelte-navigator";
	import LoginCheck from "./routes/LoginCheck.svelte";

	// export let url = "";
</script>

<!-- <Router {url}>
	<nav>
		<Link to="/">Home</Link>
		<Link to="loginCheck">LoginCheck</Link>
		<Link to="blog">Blog</Link>
	</nav>
	<div>
		<Route path="loginCheck" component={LoginCheck} />
	</div>
</Router> -->

<Router primary={false}>
	<header>
		<h1>History</h1>

		<nav>
			<Link to="/">Home</Link>
			<Link to="loginCheck">LoginCheck</Link>
			<Link to="profile">Profile</Link>
		</nav>
	</header>

	<main>
		<Route path="loginCheck">
			<LoginCheck />
		</Route>

		<Route path="/">
			<h3>Home</h3>
			<p>Home sweet home...</p>
		</Route>

		<Route path="about">
			<h3>About</h3>
			<p>That's what it's all about!</p>
		</Route>
	</main>
</Router>

Home
