<template>
  <SidebarItem
    screen="Queue"
    href="#/queue"
    :icon="faListOl"
    :class="droppable && 'droppable'"
    @dragleave="onQueueDragLeave"
    @dragover.prevent="onQueueDragOver"
    @drop="onQueueDrop"
  >
    File d'attente actuelle
  </SidebarItem>
</template>

<script lang="ts" setup>
import { faListOl } from '@fortawesome/free-solid-svg-icons'
import { ref } from 'vue'
import { queueStore } from '@/stores'
import { useDroppable, useMessageToaster } from '@/composables'

import SidebarItem from './SidebarItem.vue'
import { pluralize } from '@/utils'

const { toastWarning, toastSuccess } = useMessageToaster()
const { acceptsDrop, resolveDroppedSongs } = useDroppable(['songs', 'album', 'artist', 'playlist', 'playlist-folder'])

const droppable = ref(false)

const onQueueDragOver = (event: DragEvent) => (droppable.value = acceptsDrop(event))
const onQueueDragLeave = () => (droppable.value = false)

const onQueueDrop = async (event: DragEvent) => {
  droppable.value = false

  event.preventDefault()
  const songs = await resolveDroppedSongs(event) || []

  if (songs.length) {
    queueStore.queue(songs)
    toastSuccess(`Ajouté ${ pluralize(songs, 'prédication') } à la file.`)
  } else {
    toastWarning('Aucune prédication applicable à la file d\'attente.')
  }

  return false
}
</script>
