import { expect, it } from 'vitest'
import UnitTestCase from '@/__tests__/UnitTestCase'
import { preferenceStore } from '@/stores'
import { volumeManager } from '@/services/volumeManager'

let input: HTMLInputElement

new class extends UnitTestCase {
  protected beforeEach (cb?: Closure) {
    super.beforeEach(() => {
      preferenceStore.volume = 5
      input = document.createElement('input')
      volumeManager.init(input)
    })
  }

  protected test () {
    it('gets volume', () => expect(volumeManager.get()).toEqual(5))

    it('sets volume', () => {
      volumeManager.set(4.2)
      expect(volumeManager.volume.value).toEqual(4.2)
      expect(input.value).toEqual('4.2')
      expect(preferenceStore.volume).toEqual(4.2)
    })

    it('mutes', () => {
      volumeManager.mute()
      expect(volumeManager.volume.value).toEqual(0)
      expect(input.value).toEqual('0')

      // muting should not persist
      expect(preferenceStore.volume).toEqual(5)
    })

    it('unmutes', () => {
      preferenceStore.volume = 7
      volumeManager.unmute()
      expect(volumeManager.volume.value).toEqual(7)
      expect(input.value).toEqual('7')
    })
  }
}
