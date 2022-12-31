<template>
  <section>
    <ScreenHeader layout="collapsed">Non Trouvé</ScreenHeader>

    <div class="main-scroll-wrap">
      <ScreenEmptyState>
        <template #icon>
          <icon :icon="faKiwiBird" :mask="faMap" transform="shrink-12" />
        </template>

        Le contenu demandé est introuvable.
      </ScreenEmptyState>
    </div>
  </section>
</template>

<script lang="ts" setup>
import { faKiwiBird, faMap } from '@fortawesome/free-solid-svg-icons'
import ScreenHeader from '@/components/ui/ScreenHeader.vue'
import ScreenEmptyState from '@/components/ui/ScreenEmptyState.vue'
//
</script>
