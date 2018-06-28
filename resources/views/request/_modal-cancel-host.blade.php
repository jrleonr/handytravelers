<modal v-if="showCancelModal" @close="showCancelModal = false">
    <template slot="header">Vas a cancelar, eso es terrible</template>
    <template slot="body">
        Eres el host
        <ul>
            <li>Se te penalizara</li>
            <li>Se te devuelve el dinero</li>
        </ul>
    </template>
    <template slot="footer">
        <button type="submit" name="cancel" class="button is-link" value="Cancel">Cancel</button>
    </template>
</modal>
