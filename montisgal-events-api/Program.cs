using Microsoft.EntityFrameworkCore;
using montisgal_events_api.Models;

var builder = WebApplication.CreateBuilder(args);

builder.Services.AddDbContext<MontisgalEventsApiContext>(
    options => options.UseMySQL(builder.Configuration.GetConnectionString("Database") ?? throw new InvalidOperationException())
);

builder.Services.AddControllers();

builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

app.UseAuthorization();

app.MapControllers();

app.Run();