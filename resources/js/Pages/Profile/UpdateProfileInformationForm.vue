<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>

            <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="username" value="Userame" />
                <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" autocomplete="username" />
                <jet-input-error :message="form.error('username')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.error('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                <jet-input-error :message="form.error('email')" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <!-- Profile Photo File Input -->
              <input type="file" class="hidden"
                          ref="avatar"
                          @change="updateAvatarPreview">

              <jet-label for="avatar" value="Avatar" />

              <!-- Current Profile Photo -->
              <div class="mt-2" v-show="! avatarPreview">
                  <img :src="user.avatar" alt="Current Profile Avatar" class="rounded-full h-20 w-20 object-cover">
              </div>

              <!-- New Profile Photo Preview -->
              <div class="mt-2" v-show="avatarPreview">
                  <span class="block rounded-full w-20 h-20"
                        :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + avatarPreview + '\');'">
                  </span>
              </div>

              <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewAvatar">
                  Select A New Avatar
              </jet-secondary-button>

              <jet-input-error :message="form.error('photo')" class="mt-2" />
          </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    username: this.user.username,
                    name: this.user.name,
                    email: this.user.email,
                    avatar: this.user.avatar,
                    photo: null,
                }, {
                    bag: 'updateProfileInformation',
                    resetOnSuccess: false,
                }),

                avatarPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                if (this.$refs.avatar) {
                    this.form.avatar = this.$refs.avatar.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    preserveScroll: true
                });
            },

            selectNewAvatar() {
                this.$refs.avatar.click();
            },

            updateAvatarPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.avatarPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.avatar.files[0]);
            },
        },
    }
</script>
