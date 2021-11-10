<template>
    <div class="principal">
        <h1>PDF</h1>
          <pdf src="/images/mala.pdf"></pdf>
    </div>
</template>

<script>

import pdf from 'vue-pdf'

export default {
    components: {
    pdf
  },
  data() {
    return {
    };
  },
  methods: {

  },
}
</script>

<style scoped>
.principal{
    margin-top: 150px;
}
</style>