<template>
  <div class="bg-zinc-200" contenteditable="false" cz-shortcut-listen="true">
    <div class="mx-auto bg-white" style="width: 100%; max-width: 480px">
      <div>
        <!-- Header -->
        <div
          class="p-10 h-[280px] flex flex-col bg-black/20 bg-cover"
          style="background-image: url(assets/banner.jpeg)"
        >
          <!-- logo -->
          <img
            :src="'/assets/logo.png'"
            width="130"
            class="absolute left-1/2 ml-[-65px]"
          />

          <!-- slides -->
          <slot name="slides"></slot>
         

          <!-- current options -->
           <slot name="current-options"></slot>
        
        </div>

        <!-- Body -->
       <slot name="body"></slot>

        <!-- Pagination -->
        
        <div class="p-10 pt-0 text-center space-y-4">
        
           <slot name="pagination"></slot>
           <slot name="buttons"></slot>
          
        </div>
      </div>
    </div>
  </div>
</template>