<script lang="ts">
	import { Router, Route, Link } from "svelte-navigator";

	import "carbon-components-svelte/css/all.css";

	// import "carbon-components-svelte/css/all.css";
	// import {
	// 	Theme,
	// 	RadioButtonGroup,
	// 	RadioButton,
	// } from "carbon-components-svelte";

	// import { CarbonTheme } from "carbon-com";

	// type CarbonTheme = "white" | "g10" | "g80" | "g90" | "g100";
	// let theme: CarbonTheme = "g90";

	import { Theme } from "carbon-components-svelte";

	import LoginCheck from "./routes/LoginCheck.svelte";
	import Page from "./routes/Page.svelte";
</script>

<!-- <Theme bind:theme />

<RadioButtonGroup legendText="Carbon theme" bind:selected={theme}>
	{#each ["white", "g10", "g80", "g90", "g100"] as value}
		<RadioButton labelText={value} {value} />
	{/each}
</RadioButtonGroup> -->

<Theme render="toggle" />

<Router primary={false}>
	<header>
		<h1>Example</h1>
		<h2>This is App.svelte</h2>

		<nav>
			<Link to="/">Home</Link>
			<Link to="loginCheck">LoginCheck</Link>
			<Link to="page">page</Link>
			<Link to="about">about</Link>
		</nav>
	</header>

	<main>
		<Route path="loginCheck">
			<LoginCheck />
		</Route>

		<Route path="page">
			<Page />
		</Route>

		<Route path="about">
			<h3>About</h3>
			<p>That's what it's all about!</p>
		</Route>
	</main>
</Router>
