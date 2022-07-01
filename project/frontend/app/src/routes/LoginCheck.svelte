<script lang="ts">
	let userName = "user1";
	let bodyJson = JSON.stringify({ username: userName });
	let loginMessage = "";
	const doLogin = async () => {
		const data = new FormData();
		data.append("username", userName);
		const res = await fetch("../../back/loginUser.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({ username: userName }),
			// body: data,
			// credentials: "include",
		});
		let res2 = await res.json();
		console.log(res2);
		loginMessage = res2.message;
	};

	let loginCheckMessage = "";
	const doLoginCheck = async () => {
		const res = await fetch("../../back/loginCheck.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({ username: userName }),
			// credentials: "include",
		});
		let res2 = await res.json();
		console.log(res2);
		loginCheckMessage = res2.message;
	};
</script>

<br />
<input bind:value={userName} />
bodyJson: {bodyJson}
<br />
<button on:click={doLogin}> login </button>
<br />
loginMessage: {loginMessage}
<br />
<button on:click={doLoginCheck}> login check </button>
<br />
loginCheckMessage: {loginCheckMessage}

<style>
</style>
