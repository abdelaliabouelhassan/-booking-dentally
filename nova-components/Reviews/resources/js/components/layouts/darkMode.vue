<template>
    <div class="my-component-reviews">
          <div :class="{ dark: dark }" class=" w-full">
            <slot></slot>
          </div>
    </div>
</template>

<script>
import { onMounted, ref } from "vue";

export default {
    setup(){
         const observer = ref(null);
         const dark = ref(false);
          onMounted(() => {
            dark.value = document.documentElement.classList.contains("dark");
            observer.value = new MutationObserver((records) => {
                records.forEach((record) => {
                    dark.value = record.target.classList.contains("dark");
                });
            });
            observer.value.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ["class"],
                childList: false,
                characterData: false,
            });
        });
        return {
            dark,
        }
    }
}
</script>