using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using montisgal_events_api.Models;

namespace montisgal_events_api.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class EventController(MontisgalEventsApiContext context) : ControllerBase
    {
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Event>>> GetEvents()
        {
            return await context.Events.ToListAsync();
        }

        [HttpGet("{id:Guid}")]
        public async Task<ActionResult<Event>> GetEvent(Guid id)
        {
            var @event = await context.Events.FindAsync(id);

            if (@event == null)
            {
                return NotFound();
            }

            return @event;
        }

        [HttpPut("{id:Guid}")]
        public async Task<IActionResult> PutEvent(Guid id, Event @event)
        {
            if (id != @event.Id)
            {
                return BadRequest();
            }

            context.Entry(@event).State = EntityState.Modified;

            try
            {
                await context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!EventExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        [HttpPost]
        public async Task<ActionResult<Event>> PostEvent(Event @event)
        {
            context.Events.Add(@event);
            await context.SaveChangesAsync();

            return CreatedAtAction("GetEvent", new { id = @event.Id }, @event);
        }

        [HttpDelete("{id:Guid}")]
        public async Task<IActionResult> DeleteEvent(Guid id)
        {
            var @event = await context.Events.FindAsync(id);
            if (@event == null)
            {
                return NotFound();
            }

            context.Events.Remove(@event);
            await context.SaveChangesAsync();

            return NoContent();
        }

        private bool EventExists(Guid id)
        {
            return context.Events.Any(e => e.Id == id);
        }
    }
}