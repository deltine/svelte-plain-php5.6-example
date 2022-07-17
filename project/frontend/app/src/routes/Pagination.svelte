<script lang="ts">
	import { onMount } from "svelte";
	import { Button, DataTable, Pagination } from "carbon-components-svelte";
	import lodash from "lodash";

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
		id: number;
		account_id: number;
		account_name: string;
		email: string;
		password: number;
		created_at: string;
		updated_at: string;
		deleted_at: string;
	};

	let rows: AccountRecord[];
	let accSetting: AccountPaginateSetting;
	let accSettingBk: AccountPaginateSetting;

	accountPaginateSetting.subscribe((value) => {
		accSetting = value;
	});

	onMount(async () => {
		console.log("onMount");

		accSettingBk = lodash.cloneDeep(accSetting);
		updateAccounts();
	});

	async function doSort(e: CustomEvent) {
		console.log("doSort");
		// console.log("e.detail.header.key", e.detail.header.key);
		// console.log("e.detail.sortDirection", e.detail.sortDirection);

		accSetting.sortKey = e.detail.header.key;
		accSetting.sortDirection = e.detail.sortDirection;
		console.log("doSort_accSetting", accSetting);

		// accountPaginateSetting.set(accSetting);

		updateAccounts();
	}

	async function doUpdate() {
		console.log("doUpdate");

		console.log("accSetting", accSetting);
		console.log("accSettingBk", accSettingBk);
		if (JSON.stringify(accSetting) !== JSON.stringify(accSettingBk)) {
			console.log("doUpdate_getAccounts");
			accSettingBk = lodash.cloneDeep(accSetting);
			// accountPaginateSetting.set(accSetting);
			updateAccounts();
		}
	}

	function doFetch() {
		console.log("doFetch!");
		rows = [
			{
				id: 1,
				account_id: 1,
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
		updateAccounts();
	}

	async function updateAccounts() {
		const response = await fetch("https://example-php.jp/get_accounts_paginate.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify(accSetting),
		});
		// console.log(response);
		let json = await response.json();
		// console.log("doPage_json", json);

		if (json.status == 1) {
			// 正常
			rows = json.data;
			console.log("doPage_rows", rows);

			accSetting.page = json.page;
			accSetting.pageSize = json.pageSize;
			accSetting.totalItems = json.totalItems;
			console.log("accSetting", accSetting);
			accountPaginateSetting.set(accSetting);
		} else {
			console.log("doPage_error");
		}
	}
</script>

<h2 class="pb-5">This is Pagination.svelte</h2>

<Button on:click={doFetch}>doFetch</Button>
<Button on:click={doGetAccountsTest}>doGetAccountsTest</Button>

<DataTable
	sortable
	title="accounts title dayo"
	description="accounts description dayo."
	pageSize={accSetting.pageSize}
	sortKey={accSetting.sortKey}
	sortDirection={accSetting.sortDirection}
	{headers}
	{rows}
	on:click:header={doSort}
/>

<Pagination
	bind:pageSize={accSetting.pageSize}
	bind:page={accSetting.page}
	pageSizes={[5, 50, 100]}
	totalItems={accSetting.totalItems}
	on:update={doUpdate}
/>
