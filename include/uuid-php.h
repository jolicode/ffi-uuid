#define FFI_LIB "/lib/x86_64-linux-gnu/libuuid.so.1"

typedef unsigned char uuid_t[16];

extern void uuid_generate_random(uuid_t out);
extern void uuid_generate_time(uuid_t out);
