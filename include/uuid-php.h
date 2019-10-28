#define FFI_SCOPE "KORBEIL_UUID"
#define FFI_LIB "/lib/x86_64-linux-gnu/libuuid.so.1"

struct uuid {
	uint32_t	time_low;
	uint16_t	time_mid;
	uint16_t	time_hi_and_version;
	uint16_t	clock_seq;
	uint8_t	node[6];
};

typedef unsigned char uuid_t[16];

/* gen_uuid.c */
extern void uuid_generate(uuid_t out);
extern void uuid_generate_random(uuid_t out);
extern void uuid_generate_time(uuid_t out);
extern int uuid_generate_time_safe(uuid_t out);
