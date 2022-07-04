// import { writable } from "svelte/store";
import type { DataTableProps } from 'carbon-components-svelte/types/DataTable/DataTable.svelte';
import { writable } from 'svelte-local-storage-store'

export type AccountPaginateSetting = {
	pageSize: number;
	page: number;
	totalItems: number;
	sortKey?: string;
	sortDirection?: "none" | "ascending" | "descending";
};

export const accountPaginateSetting = writable<AccountPaginateSetting>("accountPaginateSetting", {
	pageSize: 5,
	page: 1,
	totalItems: 0,
	sortKey: null,
	sortDirection: null,
});
