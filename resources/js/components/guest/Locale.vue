<template lang="html">
  <v-col class="d-flex" id="selectLocale">
        <v-select
          :items="locales"
          item-text="name"
          item-value="value"
          v-model='currentLocale'
          :label="$t('header.localeTitle')"
        >
        </v-select>
      </v-col>

</template>

<script>
export default {





}
</script>

<style lang="css" scoped>
</style>
