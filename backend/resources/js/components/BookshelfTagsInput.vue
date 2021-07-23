<template>
  <div>
      <input
      type="hidden"
      name="picture_book_id"
      :value="tagsValue"
    >
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      placeholder="登録絵本のタイトル入力"
      :autocomplete-items="filteredItems"
      :add-only-from-autocomplete="true"
      :max-tags="1"
      :add-on-key="[13, 32]"
      @tags-changed="newTags => tags = newTags"
    />
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
    autocompleteItems: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      tag: '',
      tags: [],
    };
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
    tagsValue() {
      return this.tags.map(function ( tag , index ) {
        if ( index === 0 ) {
            return tag['picture_book_id'];
            };
      });

    },
  },
};
</script>
<style lang="css" scoped>
  .vue-tags-input {
    max-width: inherit;
  }
</style>
<style lang="css">
  .vue-tags-input .ti-tag {
    background: #26a69a;
    border: 1px solid #26a69a;
    color: #fff;
    margin-right: 4px;
    border-radius: 1px;
    font-size: 14px;
  }
  .vue-tags-input .ti-autocomplete {
    font-size: 14px;
  }
  .vue-tags-input .ti-item.ti-selected-item {
    background: #26a69a;
  }
</style>
