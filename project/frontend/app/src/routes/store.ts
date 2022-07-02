import { writable } from "svelte/store";

export type AccountPaginateSetting = {
	pageSize: number;
	page: number;
	totalItems: number;
};

export const accountPaginateSetting = writable<AccountPaginateSetting>({
	pageSize: 5,
	page: 1,
	totalItems: 0,
});
