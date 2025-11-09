<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import Button from "@/components/ui/button/Button.vue";

interface Props {
    links: Array<{ url: string | null; label: string; active: boolean }>;
}

defineProps<Props>()
</script>

<template>
    <div v-if="links.length > 3" class="flex flex-wrap gap-1">
        <template v-for="(link, key) in links">
            <Button v-if="link.url === null"
                :key="key"
                variant="outline"
                disabled>
                <span v-html="link.label" />
            </Button>
            <Link v-else 
                :key="`link-${key}`" 
                :href="link.url">
                <Button :variant="link.active ? 'default' : 'outline'">
                    <span v-html="link.label" />
                </Button>
            </Link>
        </template>
    </div>
</template>