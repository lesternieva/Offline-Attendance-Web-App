const button = document.getElementById('check_in_button');

// one-time-check-in-per-gatecode-guard ahhh
document.addEventListener('DOMContentLoaded', function() {
    try {
        const gateCode = document.getElementById('gate_code').textContent;
        const storageKey = 'checkedin_' + gateCode;

        if(localStorage.getItem(storageKey)){
            console.log('tama naaaaaaaaaaa');
            document.getElementById('check_in_button').disabled = true;
            document.getElementById('check_in_button').textContent = 'Already Checked In';
            document.getElementById('check_in_button').style.backgroundColor = '#a0a0a0';
            document.getElementById('student_name').disabled = true;
            document.getElementById('student_no').disabled = true;
        }
    } catch (error) {
        console.log('kakaselpon mo yan');
    }
    
});

// Dynamic Coloring
const subjectColors = {
    "SSP 101d*": { // blue
        primary: "#7daacb",
        secondary: "#efe3bf",
        tertiary: "#376485"
    },

    "MAT 401": { // red
        primary: "#db1a1a",
        secondary: "#fff6f6",
        tertiary: "#e98b8b"
    },

    "RLW 101": { // brown
        primary: "#8c5a3c",
        secondary: "#fff8f0",
        tertiary: "#c08552"
    },

    "MAT 402": { // violet
        primary: "#4b164c",
        secondary: "#f5f5f5",
        tertiary: "#f8e7f6"
    },

    "MCS 401L": { // green
        primary: "#3a7d44",
        secondary: "#f8f5e9",
        tertiary: "#9dc08b"
    },

    "MCS 401": { // green
        primary: "#3a7d44",
        secondary: "#f8f5e9",
        tertiary: "#9dc08b"
    },

    "default": { // blood
        primary: "#ff0000",
        secondary: "#100507",
        tertiary: "#480202"
    }
}
function applyTheme(subjectName){
    let activePalette = subjectColors[subjectName];
    const root = document.documentElement;

    if(!activePalette) {
        activePalette = subjectColors["default"];
        button.textContent = 'T̴̘̯̃h̸̩̗̒e̸͙̓̆̾r̸̺̿͌̿e̴̫̥̠͝ ̶̧͖͗̀a̵̺̽r̸̪͉̀̓e̷̞̒̌̀ ̵̝̪̈c̸̛ͅu̸̬̹̿̀̎r̶͈̈́̍r̷̬͚͗̃e̴̢̧̡͒͝n̶̡̘̬̅̓t̸̫̦̰̃̉l̶͓̜͓̎̀y̷̥̎̒ ̵̻̠̎n̸̗̐̋̅͜o̴̧͉̗̚ ̵̞̼͔͝c̸̮̯̄̈̚l̸̩̒̏a̸̳͂s̵̝̐s̴̮͈̫̊̐ě̴̼̤s̵͓̖̓ ̵̟̹̣̓́̀';
        button.style.backgroundColor = activePalette.secondary;
        document.getElementById('rollCall').textContent = "w̴̧̧̛͔͍̣̺͇̦̭̯̬̲̯̰̼̱̪̮̤̱̒̐̔̊̑͐̿̏̑͌̔̿̇́̈͋̈́̀͜͠͝ͅȟ̷̨̢̨̨̛̼̦̩̱̗̘̮̰̦̝̙̫̟͈̗̹̟̜͓̪̭̘̬͙̗̊̽͌̿̓̅̍̑̂̓͆̒̈́͂̽͜͜͠͠ỳ̶̡̡̛̹̻̥̩̰̫̹̦̞͕̗̱̀͆͛̊̏̍̿̑̄̈̔͒̄̅̀̒́̽͛̕̚͝ ̴̢̧̧̢̧̛̛̮͉͓͍̠̟̬̭̞̩͉̞̘͎̳͈̟͍̺̭̻̑̑̄̀̋͑͗͆̄̄̅̂͌͌̾̀̈̊͒̉̎̿̿͆́̊̓̎̓͗̕͘͝͝y̶̫͉̮̤͖̞̝̰̹̭͇̿̀̽̿̍͊̑̌̀̓͛̅͛͂̏̿̀̊̈́͆́̄̐̍̀́̈́̕͝͝͠͝ͅͅo̸̧̢̨̧͉̫̦͎̝̬̥̞̝͓͖̱̫͈̤̜͇̭͈̰̹̊̃́̂̽̿̉́̆̊̀͒̄̔̔̌̂͆͗̆̌́̋̔̚͘͝͝ų̴̡̢̡̨̧̧͍̜̣͉͔̲̪̮̖͓̤̩̜͚̦̈́̏͐͌̃̆̀̅̉̆͊̈́̋͆̈́̈́̅̅́͆̀͌́͊̊́̂͗̈́̕'̸̨̡̬͎̰͓͓͕̳͎̻̳̘̮̹͉͎̱̤́͋̒̏̈̆̈́͌͂̓̐̂͑̒̋̃̊̕͝͝r̸̼̰̄̍̒̆̐͗̈̈́́̈̌̋́̓͋̌̄́̍͒̒̂̍̃͌̆̃̚͝͝͝͠ë̶̛̯̯́͗̑̄͗̾̀̏̄̿́̽́̚͜͠ ̸̧̨̨̢̺͓̖̤̤͍͕̯̖͍̖͉̯̱͚̯̦̣̘̩͐̄̓̍̓͋̈́̓͗̾̋̈́̏̑̋͐͛̃̄̕͠ḩ̸̖͔̙̱̦̟̙̞̘̗͇͓̫̯̤̬͖̇̎͗̑̓̈́̇̏̒̐́͂̌̄̓̊͜ē̵̟̭̉̃̃̊̒̈̍̃̾̎̎͌̌̔̓̈͗͑̄̈̀̅̋̎̒̄̚͘̚̕͜r̶̨̙͍͇̳̭͚̮͎͍͔̫͍͔̟̻̠̖̥̙͎͎̰̟̰̤̂̎̚ͅe̴̢̡̢̻̺̻͈̤͍̟͓̬͓̠̖̼͈͔͕̺̰̬͇̩̠̒̀̏̅̅̚͝ͅ?";
        document.getElementById('sessionCard').style.backgroundColor = activePalette.primary;
        document.getElementById('reminders').textContent = "B̶̜͕͚͑͐͌̋̑̓͘͝é̸̲̙͇͈̖̬̣̣͉͆͛̿̈̑͛̌͒̒̈́͝͝ ̶̡̝͍̩̞̘͚̱̖̰̻̍̿͘ͅf̸̧̛̳̖̰̥̟͇̭̘͌̉̔̍̌̕͜a̸̡̧̝͉̙̭̭͔̔͋͑̓͂͐̅̕ì̷̛̤̺̝̺̈́̈́͒̾̿̑̃̃͆͐͝r̶̡̛̳͎̗̟͉͇͉̩͍̉̒̈́̏͗͘̕!̶̡͍̦̤̺͚̈́̍̊͑̃͛͊͗͝ͅ ̸̭̙̝͠ͅD̴͍̤̯͆̒̏ō̴̧̱̳̺͇̥̼͕̈́̎͗͐̿̽͝͝n̷̝̱̯̟̓͛̀̈́̈̌̀̈́̂'̷̧̢̹̰̤̗̳̙̭̈̑̓͊̄̕͝t̶̳͈̹́ͅ ̸̢̝͙͚̠̄͂̓̉̔̆ͅc̷̩̺̤̦͐̔͛͐͂̔͋͗̊̃̅͝͠h̷̢̜͓̗͂̈e̷̱̟̬̠̩̊̾c̴̡̣͇̪̼̟̘͗̆͗́̐̊́͋̚k̸̬̫̉͋͐̾̅̂̆̚-̴̢̧̺̰̤͚̼̼͙̹̮͐̊͊̀͒͒̓̊̾i̵̡̼̳̬̤͕͒͋͘͠ṅ̵̼̰̫͓̮̜̈͋̍̈́͘ ̴̭͍̯͇͈͙̲͇͍͙͚͖͂̾̅͊͛̎͑̔̏̾̕͘a̷̧̺̩̠̥͙̙̅̓͐̅͆̈́ͅb̴̢̜̭͈̞̖̦̮͈͉̘̀̓͆̏͛͂̈́ͅṣ̸̝͈̳̖̊̉̇͂̏̈̄̔͜͠͠ę̵̤̲̩̩͕̤̺̠̬͈͖̂̎̇̇̃̍͝n̵̨̨̺͇̮͚̺͙͉̘͒̽̈́̆̚͝t̸̘̿̈́ͅe̵̯͔͓͙̠̽͛̄͠͝e̸̻̮̹̬̺̕s̷̱̽̒̀͛͌̀́͘͘͝.̷̡̨͉̹̼͓̯̟̻̱̬̟̑̏̒̈́͋̉̓̃̐̑̚̚͝ ̶̩̼̻̜̹͉͓͉͉̼̰̰͇̎̽̔͗̈̏̂͆͘̚̚O̶̧̨̧̧̹͉̬̜̲͊ͅn̶̨̩͕̺͉͍̽̐̓ḛ̸̛͉͈̼͎̖̣̯̳̯͕̦̿̄̌̌̿͝ ̴͈̜͚̳̬̉̃̀͜c̸͙̞̱̰̹͆͌̍̅̔͑̋͋̑̋̆́ḫ̶̨̠̖̺̗̱̩̱̝̈́͑͠ͅe̵͉͈͊̄́͆̈͐̊̿̇̀͘̚ç̷̪̳̥͕̖̞͍͇̎̀͑͗͗̉̈́̈́́̓͊͘ͅk̵̪̲̅̅̓͆͒̄͊̍̿̀̃ͅ-̴̧͎̱̙̙͓͎̈́̆͑̒̕͜ͅi̸̭̓̑ṅ̵̰͈̟̜̘̟̠̭̮̙̘̜̑͊̍̌͆̆͋̔̈́̎̚͘ ̷͖͎̀̈̎͛͐̇͌̚̕p̴͍̜̰̻̹̹̂̋̒͆̈́̒̕e̸̢̥̰͎̺͎̞̰͖̠͛̎͑̈̍̊̌͘͝r̵̡̛͍͕̦̎̈́̐́́́̽̅͘͘͠͝ ̸̨̱̙͚̗̦̹̳̾̕͘d̷̙̳̩͆͊̋ę̷̥͆͗͊̈́́̈̐̊̽͒͝v̷̨̥͍̦̫̗̙͖̩̀̍̍́͋̍̃̕͝i̷̛̙͈̫̠̖̙͈̲̳̱̻͊̉̓͗͂̑̐̈́͜͠c̵̜͕͉̫͎͈̙̅̐ȩ̴̡̡͇̱̭̺̠̤͇͋̓̽ͅͅ,̶̡̟̮̈́́͆ ̶̡̧̨̢̛̛͎̦̝̂̃̋̅̇̄̿͂̍̕̕p̵̗̞̆͋ȩ̷̛͔̫̥̤̰͍̈̍̋͋́̏̈́r̷̻̯͙̰̠̼̣̼͖̐̈́̒̓͒͗̔̇͘͝ ̴͇̜͋́̽͠ͅs̶̘̤̭͕͍̼̼̰̝̦̔̾͛̊͗e̶̮̼̪̳̣̠̞̯̜̹̭͊̂̆̃͝s̶̠̖̳̣̳͈̟̦̲̊͑͒͜s̶̨̜̙̀̆̒̅̚͜͝ì̵̛̞̘̝̹̠͚̝̮͉̹̦̈́̈͊̌̾͝o̵̦̼͓̜̱͔͂͐͜͠ͅn̵̡̛͔̝̰̹̥̎̎̌̄͒̿̈͝͝ͅͅ.̴̗̪͈̐͐̌̽̓͂̀̔͘͠ ̶̨̛̘̹̝͓̹̯̟̳̣̰̎͐̍̂͂̅̎̐͜͝C̷͙̝̯̖͖͇̐͋̔̚͝o̵̧͚̬̝̲̲̹̙͇͆͜d̵̘̟̫͕̤͇̄̌́̈́̇̉̈͒̽̀͠ȩ̴̝͈̳̠̞͚̹̠̐̈́́͂̈́̆̍̑͑̈́̏ ̴̻̦͉̭̾͛̄̄̐̾̽̍̾̈́͛͑į̴͕̾̏̑̈́͒̓̅̓s̸̢̻̹̺͇̘͓͑͆̊̕ͅ ̸̦̈͐́̈́͛̀̄̓͐̃v̸̢̡͔̱̱͓̭͔̻̞̩̉͒̍͜͜͝a̸̧̨͓̩̲͙̯͇̳̹̠͇̅͌̉̈́͘͜l̸̨̢̗͓̩͍̙̠̂̚̚í̶̢̩͊̽͐͋͊̋͘͠ḋ̸̨̺̻̳̭̜̥͓͎̬̟͕̀͂̈́̽̉̓̿͋́̽̓̽ ̷̢̢̧͚͙̜͎̙̜̼̳͍̋̔̽͛͊͑̈̆̈͘̚͠f̷̝͓̉̓̒̏͌́͋o̶̥̠̞̜͖̱͖͎̙̼͊r̸͎͆ ̸̙̘͗̉̌̓̊̍̌̈͠4̴̤̦̠̱̹̤̞̿5̸̪͇̥͑͘ ̴̼̒̆͗̾̈̋͗͛̕̕̕͝͝m̷̪̓̀̒͗̽͆͠į̵̯͉̱̯͚̦̪̯̲̩̈̐̽͋́̆͂͆̒ṇ̶̪̦̤͚̭̱͈͕͎̉̾͌͋̈̑͊̄́͝ȕ̵͚̗͍͚͍̬̑́̕̚̚͘͝t̴̢̧͔̤̎̀̔̍ĕ̵̢͇̈͗̇̍͆͂ş̸̢̛͙͍̘͎̱̱̟̘̤̩́̒̇͒͠ͅ ̸͍̤͚̟̬̙͉͈̅̀̒̀͝o̵̦̖̜͉̦̜̹̙͎̠̅̅͊̓ͅņ̷̗̪͓̟̗̹͍̫̠̬͒̓̎́͑̂̆̃̐́̑͜͜ļ̵̟͕̝̘͈̦̀͆̈́̈́́̃̀̽͂̀͜y̶̥͔̋̑̅͂̎͒̀̉͠.̷͍̱̩̭̲͓̞̍̀̋̈́̌͘͝"
        document.getElementById('reminders').style.color = activePalette.primary 
        document.getElementById('sessionCard').style.color = activePalette.tertiary;
        document.getElementById('labelClock').textContent = 'Ť̵̨̺̮͑̑̈i̴̘̲̗͓͖͍̭͆͂̀͜m̸̩̒̃̀̏̊̐̀̒͋̋̐̾́e̸̜̋̆̎̾͐͑̈͝͝͠͝ ̶̢̢̛͇̼̘̰̯̫͕͚̂̀̔̄̋͊̓͊̌̓̒͂͋ň̵̡̜̰̮̥̥̰̪͎͉̣̞̼̎͒̔́̆̐̍̽͐̂͋͋ȩ̴̭̜̮̤͎͈͙̬̰̟̇̒̋̃̅͋̀̑͆́̈̕͝v̶̮͚̜̘̞͙̤̝͍͚̏̊͂̓̃͆̽̒͛̈́̂̊̈́̄ͅe̶̢̘̰͍̖̥̥̺̥̗̯̰̋̉͑̈r̸̡̼͉̳̝̋̉̀̍͗̆ ̸̧̱̞͓̱͍̈̑̈́̄E̴͓̲̜̮͙͎̤̣̖̗̱̳͑̎̿̈́̓͝͝x̸̢̢̧̝̤̞̞̱̪͍̝́̊̿̑ͅĩ̵̧͈̺̟̠̺̪̀̿̿͛̀s̵̢̡̛͈͔͕͈̖̱͔̼̝̭̟͚̅̍͆t̸̢̲̻̩̰̭͉͚̗̺͍͓̥̘̺̂͗s̶̝̦͕̼̥̩̀̇̃͑̋͗͊̓!̶̢̨̬̖͉͚͙̘͈̺̘̒̓͌̽̀̆̆͌̌͝͠!̸̛̛̪͎̲͔̺͖͉̲̭̠͎̭̽͛̿̄́̊̾̅͒̐́̚͘ͅͅ!̷̢̡̨̧̙͉̲̱̤̩͎͈̺̈̇̋̈͑̋̍̐͛̚͘̚͝'
        document.getElementById('student_name').value = 'I̴̞͊͛̚ ̸̳̱̬͝w̸͔͗̚i̸̛̫̾͊̑l̶̩̻̯͘l̸̗̮̳̅̉̉͝ ̷͙̹̠̀͑́ȁ̵͔̞̼͑̎͝l̷̞̼͐̏̈́͘w̵̛̥̟̋̽̚ḁ̵̍y̵̤̱̥̐ͅs̷͕̦̄́ ̶̡͈̭͌́̍̆ͅf̸͕̊̒͠i̵͎̝̺̊̐̔n̸̼̽͝d̶̞̳̹͛ ̷̩̄̑̕y̸̥̑ỏ̶͙͙͓̭̐̐u̴̼̞͠!̵̼͎̔̕͜';
        document.getElementById('student_name').style.color = activePalette.primary;
        document.getElementById('student_name').style.backgroundColor = activePalette.tertiary;
        document.getElementById('student_no').value = '𝟎⃥⃒̸𝟗⃥⃒̸𝟎⃥⃒̸-⃥⃒̸𝟒⃥⃒̸𝟒⃥⃒̸𝟒⃥⃒̸𝟒⃥⃒̸-⃥⃒̸𝟒⃥⃒̸𝟒⃥⃒̸𝟒⃥⃒̸';
        document.getElementById('student_no').style.color = activePalette.primary;
        document.getElementById('student_no').style.backgroundColor = activePalette.tertiary;
        
        document.getElementById('check_in_button').disabled = true;
        document.getElementById('student_name').disabled = true;
        document.getElementById('student_no').disabled = true;
    }

    root.style.setProperty('--primary-color', activePalette.primary);
    root.style.setProperty('--secondary-color', activePalette.secondary);
    root.style.setProperty('--tertiary-color', activePalette.tertiary);
    console.log(subjectName);
}
document.addEventListener('DOMContentLoaded', function() {
    applyTheme(currentSubject);
});


// checker of successful check in
try {
    
    button.addEventListener('click', function() {
        const studentName = document.getElementById('student_name').value;
        const timeIn = document.getElementById('clock').textContent;
        const gateCode = document.getElementById('gate_code').textContent;
        const storageKey = 'checkedin_' + gateCode;
        /* const sessionDate = document.getElementById('session_date').textContent; */
        
        if(localStorage.getItem(storageKey)) {
            alert('This device has already checked in.');
            return;
        }

        if (studentName.trim() === '') {
            alert('Please enter your name.');
            return;
        }  

        fetch('submit-check-in.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                student_name: studentName,
                gate_code: gateCode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // this is the MARKER ====================================
                localStorage.setItem(storageKey, 'true');
                alert('Check-in successful.');
                button.disabled = true;
                button.textContent = 'Done! Checked In';
                button.style.backgroundColor = 'a0a0a0';
            } else {
                alert('Check-in failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the check-in.');
        });

    });
} catch (error) {
    console.log('8080 ka');
}

//  message box fade out transition
document.addEventListener('DOMContentLoaded', () => {
    const msg = document.getElementById('registrationMessage');
    if(msg){
        // wait 3 sec from opacity 0 to display 
        setTimeout(() => {
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-10px)';

            // then transitions for about 0.5 seconds after 3 sec
            setTimeout(() => {
                msg.style.display = 'none';
            }, 500);
        }, 5000);
    }
});

// check all subjects if 'ALL' checkbox is ticked
document.addEventListener('DOMContentLoaded', () => {
    // Event Delegation: Attach to document so it never fails
    document.addEventListener('change', (event) => {
        
        // Handle "Select All" logic
        if (event.target && event.target.id === 'selectAllSubjects') {
            const isChecked = event.target.checked;
            // IMPORTANT: Match the [] in your HTML name attribute
            const checkboxes = document.querySelectorAll('input[name="subjects[]"]');
            
            checkboxes.forEach(cb => {
                cb.checked = isChecked;
            });
        }

        // Handle individual checkbox logic
        if (event.target && event.target.name === 'subjects[]') {
            const selectAll = document.getElementById('selectAllSubjects');
            const checkboxes = document.querySelectorAll('input[name="subjects[]"]');
            
            if (selectAll) {
                if (!event.target.checked) {
                    selectAll.checked = false;
                } else {
                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                    selectAll.checked = allChecked;
                }
            }
        }
    });
});
