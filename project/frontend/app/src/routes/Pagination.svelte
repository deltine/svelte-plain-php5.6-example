<script lang="ts">
	import { onMount } from "svelte";
	import { Button, DataTable, Pagination } from "carbon-components-svelte";

	import { accounts } from "./data-accounts";
	import { accountPaginateSetting, AccountPaginateSetting } from "./store";

	let headers = [
		{ key: "account_id", value: "account_id" },
		{ key: "account_name", value: "account_name" },
		{ key: "email", value: "email" },
		{ key: "password", value: "password" },
		{
			key: "created_at",
			value: "created_at",
			display: (date) => new Date(date).toLocaleString(),
		},
		{
			key: "updated_at",
			value: "updated_at",
			display: (date) => new Date(date).toLocaleString(),
		},
		{
			key: "deleted_at",
			value: "deleted_at",
			display: (date) => new Date(date).toLocaleString(),
		},
	];

	type AccountRecord = {
		id: string;
		account_id: string;
		account_name: string;
		email: string;
		password: number;
		created_at: string;
		updated_at: string;
		deleted_at: string;
	};

	let rows: AccountRecord[];

	let accSetting: AccountPaginateSetting;
	accountPaginateSetting.subscribe((value) => {
		accSetting = value;
	});

	onMount(async () => {
		console.log("onMount");
		// const url = "api/get_accounts.php";
		// let response = await fetch(url);
		// // console.log(response);
		// let json = await response.json();
		// console.log("json", json);
		// console.log("testdata", json.data[0].account_id);
		// if (json.status == 1) {
		// 	$accounts = json.data;
		// 	rows = json.data;
		// 	console.log("rows", rows);
		// 	accountPaginateSetting.set(accSetting);
		// } else {
		// 	$accounts = ["record not found"];
		// }

		const response = await fetch("api/get_accounts_paginate.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify(accSetting),
		});
		// console.log(response);
		let json = await response.json();
		console.log("onMount_json", json);

		// if (json.status == true) {
		// 	console.log("onMount_json_test");
		// }
	});

	function doSort(e: CustomEvent) {
		console.log("e.detail.header.key", e.detail.header.key);
		console.log("e.detail.sortDirection", e.detail.sortDirection);
		console.log("accSetting", accSetting);
	}

	async function doPage(e: CustomEvent) {
		console.log("e", e);
		// console.log("e.detail.header.key", e.detail.header.key);
		// console.log("e.detail.sortDirection", e.detail.sortDirection);
		console.log("accSetting", accSetting);

		const response = await fetch("api/get_accounts_paginate.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({
				page: 2,
				pageSizes: 50,
				sortKey: "account_id",
				sortDirection: "descending",
			}),
		});
		// console.log(response);
		let json = await response.json();
	}

	function doFetch() {
		console.log("doFetch!");
		rows = [
			{
				id: "1",
				account_id: "1",
				account_name: "name",
				email: "email",
				password: 123,
				created_at: "2022/01/01",
				updated_at: "2022/01/01",
				deleted_at: "2022/01/01",
			},
		];
	}

	async function doGetAccountsTest() {
		console.log("doGetAccountsTest!");
		const response = await fetch("api/get_accounts_paginate.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({
				page: 2,
				pageSizes: 50,
				sortKey: "account_id",
				sortDirection: "descending",
			}),
		});
		// console.log(response);
		let json = await response.json();
		console.log("json", json);
		// console.log("testdata", json.data[0].account_id);
		// if (json.status == 1) {
		// 	$accounts = json.data;
		// 	rows = json.data;
		// 	console.log("rows", rows);
		// 	pagination.totalItems = rows.length;
		// } else {
		// 	$accounts = ["record not found"];
		// }
	}
</script>

pages

<Button on:click={doFetch}>doFetch</Button>
<Button on:click={doGetAccountsTest}>doGetAccountsTest</Button>

<DataTable
	sortable
	title="accounts title dayo"
	description="accounts description dayo."
	pageSize={accSetting.pageSize}
	page={accSetting.page}
	{headers}
	{rows}
	on:click:header={doSort}
/>

<Pagination
	bind:pageSize={accSetting.pageSize}
	bind:page={accSetting.page}
	pageSizes={[5, 50, 100]}
	totalItems={accSetting.totalItems}
	on:click:button--next={doPage}
	on:click:button--previous={doPage}
/>
