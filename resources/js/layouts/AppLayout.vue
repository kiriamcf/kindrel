<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue'
import type { BreadcrumbItemType } from '@/types'

import {
    ToastProvider,
    ToastViewport,
    Toast,
} from '@/components/ui/toast'
import { useToast } from '@/composables/useToast'
import { usePage } from '@inertiajs/vue3'
import { watch } from 'vue'

interface Props {
    breadcrumbs?: BreadcrumbItemType[]
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
})

const { toasts, toast, dismiss } = useToast()
const page = usePage()

watch(
    () => page.props.flash,
    flash => {
        if (!flash) return

        if (flash.success) {
            toast({
                title: 'Success',
                description: flash.success,
            })
        }

        if (flash.error) {
            toast({
                title: 'Error',
                description: flash.error,
                duration: 6000,
            })
        }
    },
    { immediate: true },
)
</script>

<template>
    <ToastProvider>
        <AppLayout :breadcrumbs="breadcrumbs">
            <slot />
        </AppLayout>

        <Toast
            v-for="toast in toasts"
            :key="toast.id"
            :title="toast.title"
            :description="toast.description"
            :duration="toast.duration"
            @open-change="open => !open && dismiss(toast.id)"
        />

        <ToastViewport
            class="fixed bottom-0 right-0 z-50 flex flex-col gap-2 p-4 sm:max-w-sm"
        />
    </ToastProvider>
</template>
