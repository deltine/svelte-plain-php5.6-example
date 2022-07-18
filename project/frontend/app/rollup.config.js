import svelte from "rollup-plugin-svelte";
import commonjs from "@rollup/plugin-commonjs";
import resolve from "@rollup/plugin-node-resolve";
import livereload from "rollup-plugin-livereload";
import { terser } from "rollup-plugin-terser";
import sveltePreprocess from "svelte-preprocess";
import typescript from "@rollup/plugin-typescript";
import css from "rollup-plugin-css-only";
import { optimizeImports, elements } from "carbon-preprocess-svelte";
import dotenv from "dotenv";

// if (process.env.NODE_ENV !== "production") {
// 	dotenv.config();
// } else {
// 	dotenv.config(".env.pr");
// }

const production = !process.env.ROLLUP_WATCH;

console.log("production", production);
if (!production) {
	console.log("dotenv.config();");
	dotenv.config();
} else {
	console.log('dotenv.config(".env.pr");');
	dotenv.config({ path: ".env.pr" });
}

function serve() {
	let server;

	function toExit() {
		if (server) server.kill(0);
	}

	return {
		writeBundle() {
			if (server) return;
			server = require("child_process").spawn("npm", ["run", "start", "--", "--dev"], {
				stdio: ["ignore", "inherit", "inherit"],
				shell: true,
			});

			process.on("SIGTERM", toExit);
			process.on("exit", toExit);
		},
	};
}

export default {
	input: "src/main.ts",
	output: {
		sourcemap: true,
		format: "iife",
		name: "app",
		file: "public/build/bundle.js",
	},
	plugins: [
		svelte({
			preprocess: [
				sveltePreprocess({ sourceMap: !production }),
				optimizeImports(),
				elements(),
			],
			compilerOptions: {
				// enable run-time checks when not in production
				dev: !production,
			},
			preprocess: sveltePreprocess({
				sourceMap: !production,
				postcss: {
					plugins: [require("tailwindcss"), require("autoprefixer")],
				},
				replace: [
					["process.env.NODE_ENV", JSON.stringify(process.env.NODE_ENV)],
					["process.env.PHP_ROOT", JSON.stringify(process.env.PHP_ROOT)],
				],
			}),
		}),
		// we'll extract any component CSS out into
		// a separate file - better for performance
		css({ output: "bundle.css" }),

		// If you have external dependencies installed from
		// npm, you'll most likely need these plugins. In
		// some cases you'll need additional configuration -
		// consult the documentation for details:
		// https://github.com/rollup/plugins/tree/master/packages/commonjs
		resolve({
			browser: true,
			dedupe: ["svelte"],
		}),
		commonjs(),
		typescript({
			sourceMap: !production,
			inlineSources: !production,
		}),

		// In dev mode, call `npm run start` once
		// the bundle has been generated
		!production && serve(),

		// Watch the `public` directory and refresh the
		// browser on changes when not in production
		!production && livereload("public"),

		// If we're building for production (npm run build
		// instead of npm run dev), minify
		production && terser(),
	],
	watch: {
		clearScreen: false,
	},
};
