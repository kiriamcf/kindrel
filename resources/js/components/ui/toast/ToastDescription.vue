<script setup lang="ts">
import { ToastDescription, type ToastDescriptionProps } from 'reka-ui'

const props = defineProps<ToastDescriptionProps>()
</script>

<template>
    <ToastDescription
        v-bind="props"
        class="text-sm text-muted-foreground"
    >
        <slot />
    </ToastDescription>
</template>
