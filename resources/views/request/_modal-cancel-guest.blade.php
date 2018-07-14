<modal v-if="showCancelModal" @close="showCancelModal = false">
    <template slot="header">Are you sure that you want to cancel the request?</template>
    <template slot="body">
        This may cause problems to your host. Are you sure?
    </template>
    <template slot="footer">
        <button type="submit" name="cancel" class="button is-link" value="Cancel">Cancel</button>
    </template>
</modal>
