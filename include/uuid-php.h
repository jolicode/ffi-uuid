#define FFI_LIB "libuuid.so.1"

typedef unsigned char uuid_t[16];

extern void uuid_generate_time(uuid_t out); // v1
extern void uuid_generate_md5(uuid_t out, const uuid_t ns, const char *name, size_t len); // v3
extern void uuid_generate_random(uuid_t out); // v4
extern void uuid_generate_sha1(uuid_t out, const uuid_t ns, const char *name, size_t len); // v5
