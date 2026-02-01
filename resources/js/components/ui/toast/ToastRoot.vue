<script setup lang="ts">
import {
    ToastRoot,
    type ToastRootProps,
    type ToastRootEmits,
    useForwardPropsEmits,
} from 'reka-ui'

const props = defineProps<ToastRootProps>()
const emits = defineEmits<ToastRootEmits>()

const forwarded = useForwardPropsEmits(props, emits)
</script>

<template>
    <ToastRoot
        data-slot="toast"
        v-bind="forwarded"
    >
        <slot />
    </ToastRoot>
</template>
