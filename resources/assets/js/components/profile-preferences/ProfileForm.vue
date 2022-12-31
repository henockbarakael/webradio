<template>
  <form data-testid="update-profile-form" @submit.prevent="update">
    <div class="form-row">
      <label>
        Mot De Passe Actuel
        <input
          v-model="profile.current_password"
          v-koel-focus
          name="current_password"
          placeholder="Obligatoire pour mettre à jour votre profil"
          required
          type="password"
        >
      </label>
    </div>

    <div class="form-row">
      <label>
        Nom
        <input id="inputProfileName" v-model="profile.name" name="name" required type="text">
      </label>
    </div>

    <div class="form-row">
      <label>
        Adresse e-mail
        <input id="inputProfileEmail" v-model="profile.email" name="email" required type="email">
      </label>
    </div>

    <div class="form-row">
      <label>
        Nouveau Mot De Passe
        <input
          id="inputProfileNewPassword"
          v-model="profile.new_password"
          autocomplete="new-password"
          name="new_password"
          placeholder="Laissez vide pour conserver le mot de passe actuel"
          type="password"
        >
        <span class="password-rules help">
          Min. 10 caractères. Il doit s'agir d'un mélange de caractères, de chiffres et de symboles.
        </span>
      </label>
    </div>

    <div class="form-row">
      <Btn class="btn-submit" type="submit">Enregistrer</Btn>
      <!-- <span v-if="isDemo()" class="demo-notice">
        Changes will not be saved in the demo version.
      </span> -->
    </div>
  </form>
</template>

<script lang="ts" setup>
import { onMounted, ref } from 'vue'
import { UpdateCurrentProfileData, userStore } from '@/stores'
import { isDemo, logger, parseValidationError } from '@/utils'
import { useDialogBox, useMessageToaster } from '@/composables'

import Btn from '@/components/ui/Btn.vue'

const { toastSuccess } = useMessageToaster()
const { showErrorDialog } = useDialogBox()
const profile = ref<UpdateCurrentProfileData>({} as unknown as UpdateCurrentProfileData)

onMounted(() => {
  profile.value = {
    name: userStore.current.name,
    email: userStore.current.email,
    current_password: null
  }
})

const update = async () => {
  if (!profile.value) {
    throw Error()
  }

  if (isDemo()) {
    toastSuccess('Profile updated.')
    return
  }

  try {
    await userStore.updateProfile(profile.value)
    profile.value.current_password = null
    delete profile.value.new_password
    toastSuccess('Profile updated.')
  } catch (error: any) {
    const msg = error.response.status === 422 ? parseValidationError(error.response.data)[0] : 'Unknown error.'
    showErrorDialog(msg, 'Error')
    logger.log(error)
  }
}
</script>

<style lang="scss" scoped>
input {
  &[type="text"], &[type="email"], &[type="password"] {
    width: 33%;
  }
}

.password-rules {
  display: block;
  margin-top: .75rem;
}

.demo-notice {
  font-size: .95rem;
  opacity: .7;
  margin-left: 5px;
}

@media only screen and (max-width: 667px) {
  input {
    &[type="text"], &[type="email"], &[type="password"] {
      width: 100%;
      height: 32px;
    }
  }
}
</style>
