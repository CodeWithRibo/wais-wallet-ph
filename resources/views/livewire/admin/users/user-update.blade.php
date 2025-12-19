<div>
    <form method="POST">
        <x-ui.fieldset label="User Information">
            <x-ui.field required>
                <x-ui.label>Full Name</x-ui.label>
                <x-ui.input placeholder="Enter Full Name"/>
                <x-ui.error name="name"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Email Address</x-ui.label>
                <x-ui.input placeholder="user@gmail.com"/>
                <x-ui.error name="email"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Password</x-ui.label>
                <x-ui.input placeholder="Enter Password"/>
                <x-ui.error name="password"/>
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Role</x-ui.label>
                <x-select-option :options="['' => 'Select Role', 'user' => 'User', 'admin' => 'Admin']"/>
                <x-ui.error name="role"/>
            </x-ui.field>

            <div class=" mt-5 flex items-center justify-center">
                <x-ui.button  color="emerald" type="submit">Create User</x-ui.button>
            </div>

        </x-ui.fieldset>
    </form>
</div>
