<script setup>
// import AlertWrapper from '@/components/AlertWrapper/AlertWrapper.vue';
// import { computed, watchEffect, onMounted } from 'vue';
// import { useStore } from 'vuex';

// const store = useStore();
// const me = computed(() => store.state.me.me);
// const switchLike = computed(() => store.state.like.switchLike);
// const userChatSelected = computed(() => store.state.chat.userChatSelected);

// const stopWatch = watchEffect(() => {
//   if (!me?.value?.user?.id) return;

//   window.Echo
//     .private(`message.${me.value.user.id}`)
//     .listen('Message', event => {

//       if (event?.chat_id == userChatSelected.value?.chat_id) {
//         store.commit('createMessage', event);
//       } else if (event?.user_id != me?.value?.user?.id) {
//         store.commit('addMessageIds', event?.chat_id);
//         store.commit('editChat', event);

//         store.dispatch('syncAddAlert', { alert: event, typeAlert: 'message' })
//       }
//     });

//   window.Echo
//     .private(`notice.${me.value.user.id}`)
//     .listen('Notice', event => {
//       store.commit('incremetNotice');

//       if (event.type == 'like' && switchLike == 'for_me') {
//         store.commit('addLike', event?.data);

//         store.dispatch('syncAddAlert', { ...event?.data, typeAlert: 'alert' })
//       }
//     });

//   stopWatch();
// },
//   {
//     flush: 'post'
//   }
// );
// onMounted(() => {
//   store.dispatch('asyncGetMe');
// });
</script>

<template>
  <div class="wrapper">
    <div class="wrapper__inner">
      <!-- <router-view /> -->
      <!-- <AlertWrapper></AlertWrapper> -->
    </div>
  </div>
</template>

<style lang="scss">
@import '@/app/scss/index.scss';
</style>