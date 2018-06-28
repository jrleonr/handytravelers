<label for="languages" class=" label">{{__('common.languages')}}</label>
<a @click="showLanguagesModal = true" >+ {{ trans('edit.editLanguages') }}</a>

<modal v-show="showLanguagesModal" @close="showLanguagesModal = false">
  <template slot="header">{{ trans('edit.whatLanguages') }}</template>
  <template slot="body">
    <div class="columns is-multiline is-mobile">
      @foreach($languages as $language)
      <div class="column is-gapless is-3"> 
        <label>
          <input type="checkbox" name="languages[{{$language['id']}}]" value="{{$language['title']}}" @if($language['value']) checked @endif> 
          {{$language['title']}}
        </label>
      </div>
      @endforeach
    </div>
  </template>
</modal>



