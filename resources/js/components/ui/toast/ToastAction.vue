<script setup lang="ts">
import { ToastAction, type ToastActionProps } from 'reka-ui'

const props = defineProps<ToastActionProps>()
</script>

<template>
    <ToastAction
        v-bind="props"
        class="inline-flex items-center justify-center rounded-md border px-3 py-1 text-sm font-medium"
    >
        <slot />
    </ToastAction>
</template>
