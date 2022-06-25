<script>
import { accounts } from "./routes/data-accounts";

</script>
<div id="accounts">
    {#each}
        <User $accounts as account/>
    {/each}
            
    ACCOUNTS
</div>