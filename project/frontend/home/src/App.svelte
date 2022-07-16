<script lang="ts">
	import { onMount } from "svelte";
	import { MetaTags } from "svelte-meta-tags";

	onMount(async () => {
		console.log("onMount");

		updateAccounts();
	});

	let testJson: String;
	async function updateAccounts() {
		const response = await fetch("https://example-php.jp/get_accounts_paginate.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			// body: JSON.stringify(accSetting),
		});
		// console.log(response);
		let json = await response.json();
		// console.log("doPage_json", json);

		if (json.status == 1) {
			// 正常
			testJson = json.data;
			console.log("testJson", testJson);
		} else {
			console.log("doPage_error");
		}
	}
</script>

<!-- https://qiita.com/oekazuma/items/f7d0231387de96a5b162 -->
<MetaTags title="タイトル" description="ディスクリプション" />

<h1>Home Page</h1>

<h3>・https://example-php.jp/get_accounts_paginate.php は https://example-home.jp からのアクセスを禁止しています。</h3>
testJson : {JSON.stringify(testJson)}