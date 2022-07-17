// import { writable } from "svelte/store";
import type { DataTableProps } from "carbon-components-svelte/types/DataTable/DataTable.svelte";
import type { CarbonTheme } from "carbon-components-svelte/types/Theme/Theme.svelte";
import { writable } from "svelte-local-storage-store";

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

export const carbonTheme = writable<CarbonTheme>("carbonTheme", "g90");

export const userName = writable<String>("userName", "user1");
