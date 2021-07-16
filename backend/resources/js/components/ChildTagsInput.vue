<template>
  <div>
    <input
      type="hidden"
      name="children"
      :value="tagsJson"
    >
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      placeholder="お子さまの追加"
      :autocomplete-items="filteredItems"
      :add-only-from-autocomplete="true"
      :add-on-key="[13, 32]"
      :autocomplete-min-length="0"
      @tags-changed="newTags => tags = newTags"
    >
      <template slot="autocomplete-header">
        <strong>　↓ お子さまを選んでください</strong>
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
    autocompleteItems: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      tag: '',
      tags: this.initialTags,
    };
  },
  computed: {
      filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
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
