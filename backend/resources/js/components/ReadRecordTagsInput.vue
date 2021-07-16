<template>
  <div>
    <input
      type="hidden"
      name="tags"
      :value="tagsJson"
    >
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      placeholder="タグを5個まで入力できます"
      :autocomplete-items="defaultItems"
      :add-on-key="[13, 32]"
      :autocomplete-min-length="0"
      @tags-changed="newTags => tags = newTags"
    >
      <template slot="autocomplete-header">
        <strong>　↓ 選択するか、入力してください</strong>
      </template>
      <template slot="autocomplete-footer">
      </template>
    </vue-tags-input>
  </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
  components: {
    VueTagsInput,
  },
  props: {
    initialTags: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      tag: '',
      tags: this.initialTags,
      defaultItems: [{
        text: 'なんども',
      }, {
        text: 'どハマり',
      }, {
        text: 'ストーリー◎',
      }, {
        text: 'キャラ◎',
      }, {
        text: 'かわいい',
      }, {
        text: '絵が好き',
      }, {
        text: '笑った',
      }, {
        text: '感動！',
      }, {
        text: 'コワい…',
      }, {
        text: 'おやすみZzz',
      }, {
        text: 'なみだ',
      }, {
        text: 'まなび',
      }, {
        text: '一人で',
      }, {
        text: '女の子',
      }, {
        text: '男の子',
      }, {
        text: '０〜１さい',
      }, {
        text: '２〜３さい',
      }, {
        text: '４さい',
      }, {
        text: '５さい',
      }, {
        text: '６さい〜',
      }],
    };
  },
  computed: {
    tagsJson() {
      return JSON.stringify(this.tags)
    },
  },
};
</script>

<style lang="css" scoped>
  .vue-tags-input {
    max-width: inherit;
  }
</style>
