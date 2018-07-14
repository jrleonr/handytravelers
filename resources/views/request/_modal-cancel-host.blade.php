<modal v-if="showCancelModal" @close="showCancelModal = false">
    <template slot="header">Are you sure that you want to cancel?</template>
    <template slot="body">
       This could be very inconvenient to your guests. Are you sure?
    </template>
    <template slot="footer">
        <button type="submit" name="cancel" class="button is-link" value="Cancel">Cancel</button>
    </template>
</modal>
