<script lang="ts">
	import { Router, Route, Link, navigate } from "svelte-navigator";
	import type { CarbonTheme } from "carbon-components-svelte/types/Theme/Theme.svelte";
	import LoginCheck from "./routes/LoginCheck.svelte";
	import GetAccounts from "./routes/GetAccounts.svelte";
	import Pagination from "./routes/Pagination.svelte";
	import { carbonTheme } from "./routes/store";
	import { Theme, RadioButtonGroup, RadioButton } from "carbon-components-svelte";
	import PrivatePage from "./routes/PrivatePage.svelte";
	import Home from "./routes/Home.svelte";

	let theme: CarbonTheme;

	carbonTheme.subscribe((value) => {
		theme = value;
	});
	$: carbonTheme.set(theme);

	console.log(process.env.PHP_ROOT);
</script>

<svelte:head>
	<title>svelte-plain-php5.6-example</title>
	<meta name="robots" content="noindex nofollow" />
	<html lang="en" />
</svelte:head>

<div>
	<Router primary={false}>
		<header>
			<h1>svelte-plain-php5.6-example</h1>

			<Theme bind:theme />

			<RadioButtonGroup legendText="Carbon theme" bind:selected={theme} class="pt-6">
				{#each ["white", "g10", "g80", "g90", "g100"] as value}
					<RadioButton labelText={value} {value} />
				{/each}
			</RadioButtonGroup>

			<nav class="pt-6 text-xl">
				<Link class="pl-0" to="/">Home</Link>
				<Link class="pl-6" to="loginCheck">LoginCheck</Link>
				<Link class="pl-6" to="private">private</Link>
				<Link class="pl-6" to="getAccounts">GetAccounts</Link>
				<Link class="pl-6" to="pagination">Pagination</Link>
				<Link class="pl-6" to="about">about</Link>
			</nav>
		</header>

		<main class="pt-6">
			<Route path="">
				<Home />
			</Route>

			<Route path="loginCheck">
				<LoginCheck />
			</Route>

			<Route path="private">
				<PrivatePage />
			</Route>

			<Route path="getAccounts">
				<GetAccounts />
			</Route>

			<Route path="pagination">
				<Pagination />
			</Route>

			<Route path="about">
				<h3>About</h3>
				<p>That's what it's all about!</p>
			</Route>
		</main>
	</Router>
</div>

<style global lang="postcss">
	@tailwind base;
	@tailwind components;
	@tailwind utilities;
</style>
