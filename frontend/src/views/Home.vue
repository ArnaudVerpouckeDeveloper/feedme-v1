<template>
<div>
  <HelloWorld />
  <HelloWorld />

  <Contact id="contact" /></div>
</template>

<script>
import Contact from "../components/Contact.vue";
import HelloWorld from "../components/HelloWorld.vue";
export default {
  name: "Home",

  components: {
    Contact,
    HelloWorld
  }
};
</script>
