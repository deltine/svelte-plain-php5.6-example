<script lang="ts">
	import { onMount } from "svelte";
	import { Button, DataTable, Pagination } from "carbon-components-svelte";

	import { accounts } from "./data-accounts";

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

	let rows: {
		id: string;
		account_id: string;
		account_name: string;
		email: string;
		password: number;
		created_at: string;
		updated_at: string;
		deleted_at: string;
	}[];

	let pagination: {
		pageSize: number;
		page: number;
		totalItems: number;
	} = {
		pageSize: 50,
		page: 1,
		totalItems: 0,
	};

	onMount(async () => {
		const url = "api/get_accounts.php";
		let response = await fetch(url);
		// console.log(response);
		let json = await response.json();
		console.log("json", json);
		console.log("testdata", json.data[0].account_id);
		if (json.status == 1) {
			$accounts = json.data;
			rows = json.data;
			console.log("rows", rows);
			pagination.totalItems = rows.length;
		} else {
			$accounts = ["record not found"];
		}
	});

	function doSort(e: CustomEvent) {
		console.log("e.detail.header.key", e.detail.header.key);
		console.log("e.detail.sortDirection", e.detail.sortDirection);
		console.log("pagination", pagination);
	}

	function doPage(e: CustomEvent) {
		console.log("e", e);
		// console.log("e.detail.header.key", e.detail.header.key);
		// console.log("e.detail.sortDirection", e.detail.sortDirection);
		console.log("pagination", pagination);
	}
</script>

get_accounts

<DataTable
	sortable
	title="accounts title dayo"
	description="accounts description dayo."
	pageSize={pagination.pageSize}
	page={pagination.page}
	{headers}
	{rows}
	on:click:header={doSort}
/>

<Pagination
	bind:pageSize={pagination.pageSize}
	bind:page={pagination.page}
	pageSizes={[5, 50, 100]}
	totalItems={pagination.totalItems}
	on:click:button--next={doPage}
	on:click:button--previous={doPage}
/>
