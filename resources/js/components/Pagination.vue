<template>
    <div v-if="links.length > 3" class="flex flex-wrap gap-1">
        <template v-for="(link, key) in links">
            <Button v-if="link.url === null"
                :key="key"
                variant="outline"
                v-html="link.label" />
            <Link v-else 
                :key="`link-${key}`" 
                :href="link.url">
                <Button :variant="link.active ? 'default' : 'outline'"
                    v-html="link.label" />
            </Link>
        </template>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import Button from "@/components/ui/button/Button.vue";

defineProps<{
  links: Array<{ url: string | null; label: string; active: boolean }>
}>()
</script>