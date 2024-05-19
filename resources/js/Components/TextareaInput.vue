<template>
  <div :class="attrs.class">
    <label v-if="label" class="block font-medium text-sm text-gray-700" :for="id">{{ label }}</label>
    <textarea
      :id="id"
      ref="input"
      v-bind="{ ...attrs, class: null }"
      class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
      :class="{ error: error }"
      :rows="rows"
      :value="modelValue"
      @input="handleInput"
    />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script setup>
import { v4 as uuid } from 'uuid'
import { ref, computed, defineProps, defineEmits, useAttrs } from 'vue'

const props = defineProps({
  id: {
    type: String,
    default: () => `textarea-input-${uuid()}`,
  },
  error: String,
  label: String,
  modelValue: String,
  rows: {
    type: Number,
    default: 3,
  },
})

const emit = defineEmits(['update:modelValue'])
const attrs = useAttrs()

const input = ref(null)

const handleInput = (event) => {
  emit('update:modelValue', event.target.value)
}

const focus = () => {
  input.value.focus()
}

const select = () => {
  input.value.select()
}

</script>
