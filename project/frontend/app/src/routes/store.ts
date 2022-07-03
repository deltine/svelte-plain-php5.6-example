// import { writable } from "svelte/store";
import { writable } from 'svelte-local-storage-store'

export type AccountPaginateSetting = {
	pageSize: number;
	page: number;
	totalItems: number;
	sortKey: string;
	sortDirection: string;
};

export const accountPaginateSetting = writable<AccountPaginateSetting>("accountPaginateSetting", {
	pageSize: 5,
	page: 1,
	totalItems: 0,
	sortKey: "",
	sortDirection: "",
});
