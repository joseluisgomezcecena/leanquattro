/// Initialize variables in Create Event
hsp = 0;
vsp = 0;
grv = 0.5;
walk_speed = 4;
run_speed = 6;
jump_speed = -10;
wall_jump_hsp = 6;
wall_jump_vsp = -8;
coyote_time = 5;
coyote_timer = 0;
jump_buffer = 5;
jump_buffer_timer = 0;
wall_sliding = false;
wall_slide_speed = 2;
friction_ground = 0.2;
friction_air = 0.05;

// Combo attack variables
combo_count = 0;
combo_timer = 0;
combo_timer_max = 30;
attacking = false;
attack_cooldown = 0;
attack_cooldown_max = 15;

/// Step Event
// Get input
key_left = keyboard_check(vk_left);
key_right = keyboard_check(vk_right);
key_jump = keyboard_check_pressed(vk_space);
key_run = keyboard_check(vk_shift);
key_attack = keyboard_check_pressed(vk_control);

// Calculate movement
var move = key_right - key_left;
var target_speed = move * (key_run ? run_speed : walk_speed);

// Apply friction and acceleration
var friction = place_meeting(x, y + 1, obj_wall) ? friction_ground : friction_air;
if (move != 0) {
    hsp = approach(hsp, target_speed, friction);
} else {
    hsp = approach(hsp, 0, friction);
}

// Gravity
vsp += grv;

// Jumping
if (key_jump) {
    jump_buffer_timer = jump_buffer;
}

if (jump_buffer_timer > 0) {
    jump_buffer_timer--;
    
    if (place_meeting(x, y + 1, obj_wall) || coyote_timer > 0) {
        vsp = jump_speed;
        jump_buffer_timer = 0;
        coyote_timer = 0;
    }
}

// Coyote time
if (place_meeting(x, y + 1, obj_wall)) {
    coyote_timer = coyote_time;
} else if (coyote_timer > 0) {
    coyote_timer--;
}

// Wall sliding and jumping
if (place_meeting(x + 1, y, obj_wall) || place_meeting(x - 1, y, obj_wall)) {
    if (!place_meeting(x, y + 1, obj_wall)) {
        wall_sliding = true;
        vsp = min(vsp, wall_slide_speed);
    }
    
    if (key_jump) {
        var wall_direction = place_meeting(x + 1, y, obj_wall) ? -1 : 1;
        hsp = wall_jump_hsp * wall_direction;
        vsp = wall_jump_vsp;
        wall_sliding = false;
    }
} else {
    wall_sliding = false;
}

// Combo attack system
if (attack_cooldown > 0) {
    attack_cooldown--;
}

if (key_attack && attack_cooldown == 0) {
    attacking = true;
    attack_cooldown = attack_cooldown_max;
    
    if (combo_timer > 0) {
        combo_count = (combo_count + 1) % 3;
    } else {
        combo_count = 0;
    }
    
    combo_timer = combo_timer_max;
    
    // Perform attack based on combo_count
    switch (combo_count) {
        case 0:
            // First attack
            // Add your attack logic here
            show_debug_message("First attack");
            break;
        case 1:
            // Second attack
            // Add your attack logic here
            show_debug_message("Second attack");
            break;
        case 2:
            // Third attack
            // Add your attack logic here
            show_debug_message("Third attack");
            break;
    }
}

if (combo_timer > 0) {
    combo_timer--;
} else {
    combo_count = 0;
}

// Horizontal collision
if (place_meeting(x + hsp, y, obj_wall)) {
    while (!place_meeting(x + sign(hsp), y, obj_wall)) {
        x += sign(hsp);
    }
    hsp = 0;
}
x += hsp;

// Vertical collision
if (place_meeting(x, y + vsp, obj_wall)) {
    while (!place_meeting(x, y + sign(vsp), obj_wall)) {
        y += sign(vsp);
    }
    vsp = 0;
}
y += vsp;

/// Helper function (add this to a Script resource)
function approach(current, target, amount) {
    if (current < target) {
        return min(current + amount, target);
    } else {
        return max(current - amount, target);
    }
}


Gomezcecegna15
joseLuis15?