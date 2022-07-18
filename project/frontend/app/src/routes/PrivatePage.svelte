<script lang="ts">
	import { onMount } from "svelte";
	import { navigate } from "svelte-navigator";
	import { userName } from "./store";

	let userNameLocal: String;
	userName.subscribe((value) => {
		userNameLocal = value;
	});

	const doLoginCheck = async () => {
		const res = await fetch(process.env.PHP_ROOT + "/loginCheck.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({ username: userNameLocal }),
			credentials: "include",
		});
		let res2 = await res.json();
		console.log(res2);
		if (!res2.status) {
			console.log("login faild.");
			navigate("/");
			return false;
		}
		return true;
	};

	let promiseDoLogin = doLoginCheck();
</script>

{#await promiseDoLogin}
	<!-- <p>login check...</p> -->
{:then isSuccess}
	{#if isSuccess}
		<h2 class="pb-5">PrivatePage.svelte</h2>
	{/if}
{:catch error}
	<p style="color: red">{error.message}</p>
{/await}
