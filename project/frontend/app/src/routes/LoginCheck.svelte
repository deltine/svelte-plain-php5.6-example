<script lang="ts">
	import { Grid, Row, Column } from "carbon-components-svelte";
	import { TextInput } from "carbon-components-svelte";
	import { Button } from "carbon-components-svelte";
	import { userName } from "./store";

	let userNameLocal: string;
	userName.subscribe((value) => {
		userNameLocal = value.toString();
	});

	let loginMessage = "";
	const doLogin = async () => {
		const data = new FormData();
		data.append("username", userNameLocal);
		const res = await fetch("https://example-php.jp/loginUser.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({ username: userNameLocal }),
			credentials: "include",
		});
		// console.log("res", res);
		let res2 = await res.json();
		console.log(res2);
		loginMessage = res2.message;
	};

	let loginCheckMessage = "";
	const doLoginCheck = async () => {
		const res = await fetch("https://example-php.jp/loginCheck.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({ username: userNameLocal }),
			credentials: "include",
		});
		let res2 = await res.json();
		console.log(res2);
		loginCheckMessage = res2.message;
	};

	let logoutMessage = "";
	const doLogount = async () => {
		const res = await fetch("https://example-php.jp/logout.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			credentials: "include",
		});
		let res2 = await res.json();
		console.log("doLogount", res2);
		logoutMessage = res2.message;
	};
</script>

<h2 class="pb-5">This is LoginCheck.svelte</h2>

<Grid>
	<Row>
		<Column>
			<TextInput
				required
				inline
				labelText="User name"
				placeholder="Enter user name..."
				bind:value={userNameLocal}
			/>
		</Column>
		<Column>
			<Button on:click={doLogin}>login</Button>
		</Column>
		<Column>
			loginMessage: {loginMessage}
		</Column>
	</Row>
	<Row class="pt-5">
		<Column />
		<Column>
			<Button on:click={doLoginCheck}>login check</Button>
		</Column>
		<Column>
			loginCheckMessage: {loginCheckMessage}
		</Column>
	</Row>
	<Row class="pt-5">
		<Column />
		<Column>
			<Button on:click={doLogount}>logout</Button>
		</Column>
		<Column>
			logoutMessage: {logoutMessage}
		</Column>
	</Row>
</Grid>

<style>
</style>
