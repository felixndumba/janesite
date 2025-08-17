<!-- M-Pesa Payment Modal -->
<!-- M-Pesa Payment Modal -->
<div id="mpesaModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-1/3 shadow-lg">
        <h4 id="modalTitle" class="font-bold text-lg mb-2">M-Pesa Payment</h4>
        <p id="modalPackage" class="text-md text-gray-600"></p>
        <p id="modalAmount" class="text-xl font-bold text-orange-600 mb-4"></p>

        <input type="text" placeholder="M-Pesa Phone Number" 
               class="border rounded w-full p-2 mb-4 focus:ring focus:ring-orange-300" />

        <p class="font-semibold">Payment Instructions:</p>
        <ol class="list-decimal pl-5 text-sm text-gray-700 mb-4">
            <li>Enter your M-Pesa registered phone number</li>
            <li>You’ll receive an STK push notification</li>
            <li>Enter your M-Pesa PIN to complete payment</li>
            <li>After payment, you’ll be redirected to book your session</li>
        </ol>

        <div class="flex justify-end space-x-3">
            <button class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400"
                    onclick="closePaymentModal()">Close</button>
            <button class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">
                Pay Now
            </button>
        </div>
    </div>
</div>
<script>
    function openPaymentModal(packageName, amount) {
        document.getElementById('modalPackage').innerText = packageName;
        document.getElementById('modalAmount').innerText = amount + ' KSH';
        document.getElementById('mpesaModal').classList.remove('hidden');
    }

    function closePaymentModal() {
        document.getElementById('mpesaModal').classList.add('hidden');
    }
</script>
