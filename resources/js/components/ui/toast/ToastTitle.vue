<script setup lang="ts">
import { ToastTitle, type ToastTitleProps } from 'reka-ui'

const props = defineProps<ToastTitleProps>()
</script>

<template>
    <ToastTitle
        v-bind="props"
        class="text-sm font-semibold"
    >
        <slot />
    </ToastTitle>
</template>
