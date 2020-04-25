<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center style="text-align:center">
      <v-flex >
        <h1 class="display-2 primary--text">Whoops, 404</h1>

        <p>De pagina die u zoekt, kon niet gevonden worden.</p>

        <v-btn
          :to="`/`"
          color="primary"
          outlined
        >Haal me hier weg!</v-btn>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {};
</script>

<style scoped>

</style>