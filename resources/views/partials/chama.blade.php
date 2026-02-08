<div class="max-w-7xl mx-auto px-6 bg-[#f9f7f4] rounded-lg shadow-lg py-6">

    <h3 class="text-2xl font-bold text-[#924c2e]">Chama Package</h3>
    <p class="text-gray-600 mt-2">
        Specialized financial guidance for investment groups and chamas.
    </p>

    <br>

    <ul class="list-none pl-5 text-gray-700 space-y-2">
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> One session
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Discovery session
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Goal setting session
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Money personalities exercise
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Aligning your goals with available investments
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Credit options
        </li>
    </ul>

    <p class="text-gray-600 mt-4">
        Kindly note this is an online session and an additional facilitation fee applies for physical sessions.
    </p>

    <div class="mt-6 p-4 bg-gray-100 rounded-md">
        <h4 class="font-bold text-gray-900">Pricing Structure</h4>
        <p class="text-gray-700">
            10,000 KSH for groups less than 5 | 2,000 KSH per person for groups above 5
        </p>
    </div>

    <div class="mt-6 flex space-x-4">

        <!-- Small group -->
        <button
            class="w-1/2 bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638] transition duration-300"
            onclick="openPaymentModal('Chama Small Group Package', '10000')">
            Book for Small Group (&lt;5)
        </button>

        <!-- Large group -->
        <div class="w-1/2">
            <input
                id="groupSizeInput"
                type="number"
                min="6"
                placeholder="Enter number of people (≥6)"
                class="border rounded-lg p-2 w-full mb-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-500 outline-none shadow-sm"
            />

            <div
                id="errorMessage"
                class="hidden mt-2 rounded-md border border-red-300 bg-red-50 px-4 py-2 text-sm text-red-700">
            </div>

            <button
                class="w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638] transition duration-300"
                onclick="handleLargeGroupBooking()">
                Book for Large Group (&gt;5)
            </button>
        </div>

    </div>
</div>

<!-- Animations -->
<style>
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    50% { transform: translateX(4px); }
    75% { transform: translateX(-4px); }
}
.animate-shake {
    animation: shake 0.3s ease-in-out;
}
</style>

<!-- Script -->
<script>
    function handleLargeGroupBooking() {
        const input = document.getElementById('groupSizeInput');
        const errorMessage = document.getElementById('errorMessage');
        const groupSize = parseInt(input.value);

        // Reset error state
        errorMessage.classList.add('hidden');
        errorMessage.textContent = '';
        input.classList.remove('border-red-500', 'animate-shake');

        if (!groupSize || groupSize < 6) {
            showError('Please enter a valid number of at least 6 people.');
            return;
        }

        const amount = groupSize * 2000;
        openPaymentModal('Chama Large Group Package', amount);
    }

    function showError(message) {
        const input = document.getElementById('groupSizeInput');
        const errorMessage = document.getElementById('errorMessage');

        errorMessage.textContent = message;
        errorMessage.classList.remove('hidden');

        input.classList.add('border-red-500', 'animate-shake');
        input.focus();
    }

    // Dummy function (replace with your real payment modal)
    function openPaymentModal(packageName, amount) {
        console.log('Package:', packageName);
        console.log('Amount:', amount);
    }
</script>
